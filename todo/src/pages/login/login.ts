import { Component } from '@angular/core';
import { NavController, AlertController, LoadingController, Loading } from 'ionic-angular';
import { Http, Headers, RequestOptions } from '@angular/http';
import { TabsPage } from '../tabs/tabs';
import { TodoPage } from '../todo/todo';
import { AppSettings } from '../../services/settings/appsettings';
import 'rxjs/Rx';

/*
  Generated class for the Login page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
  providers: [AppSettings]
})
export class LoginPage {

  loading: Loading;
  option = {
  	id:'',
  	pass:''
  };
  data = {};
  authData;
  tabBarElement;
  constructor(public navCtrl: NavController,
              private alertCtrl: AlertController,
              private loadingCtrl: LoadingController,
              private http: Http,
              private appsettings: AppSettings) {

    this.tabBarElement = document.querySelector('#tabs ion-tabbar-section');
  }
  login(){
  	this.showLoading();
  	var link = this.appsettings.api + 'login';
    let body = new FormData();
    body.append('id',this.option.id);
    body.append('pass',this.option.pass);
    this.http.post(link, body)
    	.map(res => res.json())
      .subscribe(
      	data => {
          if(data.data.status){
            localStorage.setItem('auth',data.data.token);

            var auth = localStorage.getItem('auth');
            this.getToken(auth);
            this.loading.dismiss();
          }else{
            this.showError('',data.data.message);
          }
        }, 
        error => {
          this.showError('Error',error);
        }
     );
  }

  private getToken(auth){
    var link = this.appsettings.api + 'getToken';

    let headers = new Headers({ 'auth': auth });
    let options = new RequestOptions({ headers: headers });
     this.http.post(link,'',options)
        .map(res => res.json())
        .subscribe(
          data => {
            if(data.role == "dosen"){
              this.navCtrl.setRoot(TabsPage);
            }else{
              this.navCtrl.setRoot(TodoPage);                
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
