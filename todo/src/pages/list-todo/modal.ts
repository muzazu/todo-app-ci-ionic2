import { Component } from '@angular/core';
import { NavParams, AlertController, LoadingController, Loading, ModalController, ViewController } from 'ionic-angular';
import { AppSettings } from '../../services/settings/appsettings';
import { Http } from '@angular/http';
import 'rxjs/Rx';

@Component({
  selector: 'modal',
  templateUrl: 'modal.html',
  providers: [AppSettings]
})
export class Modal3Page {
  loading:Loading;
  groups;
  userArray;
  myInput = "";
  items;
  bItems;
  title;
  desc;
  deadline;
  idmhs;
  mhs;

  search = false;

  constructor(
    public params: NavParams,
    public viewCtrl: ViewController,
    private alertCtrl: AlertController,
    private loadingCtrl: LoadingController,
    private http: Http,
    private modalCtrl: ModalController,
    private navParams: NavParams,
    private appsettings: AppSettings
  ) {
    this.groups = navParams.get('id');
    this.loadMhs();
  }

  dismiss() {
    this.viewCtrl.dismiss();
  }

  loadMhs(){
    this.showLoading();
    var link = this.appsettings.api + 'getcustom?idgroup='+this.groups;
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
    console.log(this.myInput.length);
    if(this.myInput.length > 0){
      this.search = true;
      this.items = this.bItems;
      this.items = this.gofilter();
    }else{
      this.search = false;
    }
  }

  private gofilter(){
     return this.items.filter((item) => {
            return item.nama.toLowerCase().indexOf(this.myInput.toLowerCase()) > -1;
        });     
  }
  save(){
    this.showLoading();
    var link = this.appsettings.api + 'todo';
    let body = new FormData();
    body.append('idgroup',this.groups);
    body.append('idmhs',this.idmhs);
    body.append('desc',this.desc);
    body.append('title',this.title);
    body.append('deadline',this.deadline);
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

  showConfirm(val,nama) {
    this.search = false;
    this.mhs = nama;
    this.idmhs = val;
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