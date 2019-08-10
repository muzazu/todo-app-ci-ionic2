import { Component } from '@angular/core';
import { NavController, NavParams, AlertController, LoadingController, Loading, ModalController } from 'ionic-angular';
import { AppSettings } from '../../services/settings/appsettings';
import { LoginPage } from '../login/login';
import { Http,Headers,RequestOptions } from '@angular/http';
import { Modal3Page } from './modal';
import 'rxjs/Rx';

/*
  Generated class for the DosenMatkulMhs page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-list-todo',
  templateUrl: 'list-todo.html',
  providers: [AppSettings]
})
export class ListTodoPage {
  loading:Loading;
  todos;
  userArray;
  matkul;
  authData;
  idgroup;
  constructor(public navCtrl: NavController, 
              public navParams: NavParams,
              private alertCtrl: AlertController,
              private loadingCtrl: LoadingController,
              private http: Http,
              private modalCtrl: ModalController,
              private appsettings: AppSettings) {
  	this.idgroup = navParams.get('idgroup');
    this.load().then(data => {
      this.userArray = data['id'];
      this.loadMhs();
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
  openModal() {
    let modal = this.modalCtrl.create(Modal3Page,{id:this.idgroup});
    modal.present();
    modal.onDidDismiss(data =>{
      this.loadMhs();
    });
  }
  
  loadMhs(){
    this.showLoading();
    var link = this.appsettings.api + 'todo?idmhs='+this.userArray+'&idgroup='+this.idgroup;
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            data.data.forEach(function(i,val){
            	if(i.status == 1)
            		i.checkbox = true;
            	else
            		i.checkbox = false;
            });
            this.todos = data.data;
            console.log(this.todos);
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

  updateStatus(id,status){
  	console.log(id);
  	if(status == 1)
  		status = 0;
  	else
  		status = 1;

  	this.showLoading();
    var link = this.appsettings.api + 'todo/'+id;
    let body = new FormData();
    body.append('status',status);
    this.http.post(link, body)
      .map(res => res.json())
      .subscribe(
        data => {
          this.showError('',data.meta.message);
          this.loadMhs();
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
