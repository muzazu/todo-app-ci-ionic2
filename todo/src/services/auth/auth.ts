import { Http, Headers, RequestOptions } from '@angular/http';
import 'rxjs/Rx';
import { AlertController, NavController } from 'ionic-angular';
import {Injectable} from "@angular/core";
import { LoginPage } from '../../pages/login/login';

@Injectable()
export class Auth {
    public authData:any;
    private api = "http://localhost/todo-api/";
    constructor(private alertCtrl: AlertController,private http: Http, public navCtrl: NavController) {
	    this.authData = null;
    }
    load() {
	    if (this.authData) {
	      return Promise.resolve(this.authData);
	    }
        var auth = localStorage.getItem('auth');
	    if(auth != null){
	      var link = this.api + 'getToken';

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

    public logout(){
    	localStorage.removeItem('auth');
    	this.navCtrl.parent.parent.setRoot(LoginPage);
    }

    private showError(header,text) { 
	    let alert = this.alertCtrl.create({
	      title: header,
	      subTitle: text,
	      buttons: ['OK']
	    });
	    alert.present(prompt);
  	}
}
