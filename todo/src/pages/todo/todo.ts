import { Component } from '@angular/core';
import { NavController, NavParams, AlertController, LoadingController, Loading, ModalController } from 'ionic-angular';
import { AppSettings } from '../../services/settings/appsettings';
import { LoginPage } from '../login/login';
import { ListTodoPage } from '../list-todo/list-todo';
import { Http,Headers,RequestOptions } from '@angular/http';
import 'rxjs/Rx';

/*
  Generated class for the DosenMatkulMhs page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-todo',
  templateUrl: 'todo.html',
  providers: [AppSettings]
})
export class TodoPage {
  loading:Loading;
  todos;
  userArray;
  matkul;
  authData;
  constructor(public navCtrl: NavController, 
              public navParams: NavParams,
              private alertCtrl: AlertController,
              private loadingCtrl: LoadingController,
              private http: Http,
              private modalCtrl: ModalController,
              private appsettings: AppSettings) {

    this.load().then(data => {
      this.userArray = data['id'];
      this.loadMhs(this.userArray);
    });
  }

  public logout(){
    localStorage.removeItem('auth');
    this.navCtrl.parent.parent.setRoot(LoginPage);
  }

  load() {
    var auth = localStorage.getItem('auth');
    if(auth != null){
      var link = this.appsettings.api + 'getToken';

      let headers = new Headers({ 'auth': auth });
      let options = new RequestOptions({ headers: headers });
	    return new Promise(resolve => {
	     	this.http.post(link,'',options)
		        .map(res => res.json())
		        .subscribe(
		          data => {
		          	if(data.exp < Math.round(new Date().getTime() / 1000)){
		          		this.logout();
		          	}
		            this.authData = data;
		            resolve(this.authData);
		          }, 
		          error => {
		            this.showError('Error',error);
		          }
	       	);
	    });
      
    }
  }
  
  loadMhs(val){
    this.showLoading();
    var link = this.appsettings.api + 'mahasiswa/'+val;
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            this.todos = data.data[0];
            this.matkul = data.data[0].matkul;
            this.loading.dismiss();
          }else{
            this.showError('', data.meta.message);
          }
        }, 
        error => {
          this.showError('Error',error);
        }
     );
  } 

  showLoading() {
    this.loading = this.loadingCtrl.create({
      content: 'Please wait...'
    });
    this.loading.present();
  }
  showMatkul(val){
    this.navCtrl.push(ListTodoPage,{idgroup:val});
  }
 
  showError(header,text) {
    setTimeout(() => {
      this.loading.dismiss();
    });
 
    let alert = this.alertCtrl.create({
      title: header,
      subTitle: text,
      buttons: ['OK']
    });
    alert.present(prompt);
  }

}
