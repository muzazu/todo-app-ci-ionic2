import { Component } from '@angular/core';
import { NavController, NavParams, AlertController, LoadingController, Loading, ModalController } from 'ionic-angular';
import { Auth } from '../../services/auth/auth';
import { AppSettings } from '../../services/settings/appsettings';
import { Modal2Page } from './modal';
import { Http } from '@angular/http';
import 'rxjs/Rx';

/*
  Generated class for the DosenMatkulMhs page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-dosen-matkul-mhs',
  templateUrl: 'dosen-matkul-mhs.html',
  providers: [Auth,AppSettings]
})
export class DosenMatkulMhsPage {
  loading:Loading;
  groups;
  userArray;
  idmatkul;
  constructor(public navCtrl: NavController, 
              public navParams: NavParams,
              private auth: Auth,
              private alertCtrl: AlertController,
              private loadingCtrl: LoadingController,
              private http: Http,
              private modalCtrl: ModalController,
              private appsettings: AppSettings) {

    this.auth.load().then(data => {
      this.userArray = data.id;
    });
    this.idmatkul = navParams.get('id');
    this.loadMhs(this.idmatkul);
  }

  openModal() {
    let modal = this.modalCtrl.create(Modal2Page, {id:this.idmatkul});
    modal.present();
    modal.onDidDismiss(data =>{
      this.loadMhs(this.idmatkul);
    });
  }
  
  loadMhs(id){
    this.showLoading();
    var link = this.appsettings.api + 'group/'+id;
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            this.groups = data.data;
            console.log(this.groups);
            this.loading.dismiss();
          }else{
            this.showError('', 'Belum ada mahasiswa.');
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
