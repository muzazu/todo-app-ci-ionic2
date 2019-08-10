import { Component } from '@angular/core';

import { NavController, AlertController, LoadingController, Loading } from 'ionic-angular';
import { Auth } from '../../services/auth/auth';
import { AppSettings } from '../../services/settings/appsettings';
import { DosenMatkulPage } from '../dosen-matkul/dosen-matkul';
import { Http } from '@angular/http';
import 'rxjs/Rx';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html',
  providers: [AppSettings,Auth]
})
export class HomePage {

  //global vars
  loading: Loading;
  listMatkul={};
  userArray;

  constructor(public navCtrl: NavController,
              private auth: Auth,
              private alertCtrl: AlertController,
              private loadingCtrl: LoadingController,
              private http: Http,
              private appsettings: AppSettings) {
    this.auth.load().then(data => {
      this.userArray = data.id;
      this.loadMatkul(data.id);
    });
  }

  loadMatkul(id){
    this.showLoading();
    var link = this.appsettings.api + 'dosen/'+id;
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            this.listMatkul = data.data[0].matkul;
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
    this.navCtrl.push(DosenMatkulPage,{id:val});
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
