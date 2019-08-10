import { Component } from '@angular/core';
import { Platform } from 'ionic-angular';
import { StatusBar, Splashscreen } from 'ionic-native';

import { TabsPage } from '../pages/tabs/tabs';
import { LoginPage } from '../pages/login/login';
import { TodoPage } from '../pages/todo/todo';
import { Http, Headers, RequestOptions } from '@angular/http';
import 'rxjs/Rx';

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  rootPage;
  constructor(platform: Platform,private http: Http) {
    platform.ready().then(() => {
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      StatusBar.styleDefault();
      Splashscreen.hide();
    });
    var auth = localStorage.getItem('auth');
    if(auth != null){
      this.getToken(auth);
    }else{
      this.rootPage = LoginPage
    }
  }

  private getToken(auth){
    var link = 'http://localhost/todo-api/getToken';

    let headers = new Headers({ 'auth': auth });
    let options = new RequestOptions({ headers: headers });
     this.http.post(link,'',options)
        .map(res => res.json())
        .subscribe(
          data => {
            if(data.role == "dosen"){
              this.rootPage = TabsPage;
            }else{
              this.rootPage = TodoPage;                
            }
          }, 
          error => {
            console.log('error');
          }
       );
  }
}