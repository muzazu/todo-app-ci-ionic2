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
export class Modal2Page {
  loading:Loading;
  groups;
  userArray;
  myInput = "";
  items;
  bItems;

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
    this.groups = navParams.get('id');
    this.loadMhs();
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }

  loadMhs(){
    this.showLoading();
    var link = this.appsettings.api + 'filtered-mahasiswa';
    this.http.get(link)
      .map(res => res.json())
      .subscribe(
        data => {
          this.items = data;
          this.bItems = data;

          this.loading.dismiss(); 
        },        
        error => {
          this.showError('Error',error);
        }
     );
  } 

  setFilteredItems(){
    this.items = this.bItems;
    this.items = this.gofilter();
  }

  private gofilter(){
     return this.items.filter((item) => {
            return item.nama.toLowerCase().indexOf(this.myInput.toLowerCase()) > -1;
        });     
  }
  save(id){
    this.showLoading();
    var link = this.appsettings.api + 'grouplist';
    let body = new FormData();
    body.append('idgroup',this.groups);
    body.append('idmhs',id);
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

  showConfirm(val) {
    let alert = this.alertCtrl.create({
      title: 'Konfirmasi',
      message: 'Anda yakin menambahkan Mahasiswa ini ?',
      buttons: [
        {
          text: 'Cancel',
          role: 'cancel',
          handler: () => {
          }
        },
        {
          text: 'Tambahkan',
          handler: () => {
            this.save(val);
          }
        }
      ]
    });
    alert.present();
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