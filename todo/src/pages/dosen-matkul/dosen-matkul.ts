import { Component } from '@angular/core';
import { NavController, NavParams, AlertController, LoadingController, Loading, ModalController } from 'ionic-angular';
import { Auth } from '../../services/auth/auth';
import { AppSettings } from '../../services/settings/appsettings';
import { DosenMatkulMhsPage } from '../dosen-matkul-mhs/dosen-matkul-mhs';
import { ModalPage } from './modal';
import { Http } from '@angular/http';
import 'rxjs/Rx';

/*
  Generated class for the DosenMatkul page.

  See http://ionicframework.com/docs/v2/components/#navigation for more info on
  Ionic pages and navigation.
*/
@Component({
  selector: 'page-dosen-matkul',
  templateUrl: 'dosen-matkul.html',
  providers: [Auth,AppSettings]
})
export class DosenMatkulPage {
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
    this.loadMatkul(this.idmatkul);
  }

  openModal() {
    let modal = this.modalCtrl.create(ModalPage, {id:this.idmatkul});
    modal.present();
    modal.onDidDismiss(data =>{
      this.loadMatkul(this.idmatkul);
    });
  }
  loadMatkul(id){
    this.showLoading();
    var link = this.appsettings.api + 'group?matkul='+id;
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          if(data.meta.status){
            this.groups = data.data;
            console.log(this.groups);
            this.loading.dismiss();
          }else{
            this.showError('', 'Belum ada kelompok pada mata kuliah Anda, tambahkan dengan menekan tombol buat diatas.');
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

  showGroup(val){
    this.navCtrl.push(DosenMatkulMhsPage,{id:val});
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
