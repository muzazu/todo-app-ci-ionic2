import { Component } from '@angular/core';
import { NavParams, AlertController, LoadingController, Loading, ModalController, ViewController } from 'ionic-angular';
import { Auth } from '../../services/auth/auth';
import { AppSettings } from '../../services/settings/appsettings';
import { Http } from '@angular/http';
import 'rxjs/Rx';

@Component({
  selector: 'modal',
  templateUrl: 'modal.html',
  providers: [Auth,AppSettings]
})
export class ModalPage {
  loading:Loading;
  groups;
  userArray;
  max=1;
  min=1;
  nama;
  idmatkul;
  constructor(
    public params: NavParams,
    public viewCtrl: ViewController,
    private auth: Auth,
    private alertCtrl: AlertController,
    private loadingCtrl: LoadingController,
    private http: Http,
    private modalCtrl: ModalController,
    private navParams: NavParams,
    private appsettings: AppSettings
  ) {
    this.auth.load().then(data => {
      this.userArray = data.id;
    });
    this.idmatkul = navParams.get('id');
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }

  save(){
    this.showLoading();
    var link = this.appsettings.api + 'group';
    let body = new FormData();
    body.append('idmatkul',this.idmatkul);
    body.append('nama',this.nama);
    body.append('max',this.max);
    body.append('min',this.min);
    this.http.post(link, body)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            this.showError('',data.meta.message);
            this.viewCtrl.dismiss();
          }else{
            this.showError('',data.meta.message);
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