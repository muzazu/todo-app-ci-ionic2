import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';
import { AboutPage } from '../pages/about/about';
import { HomePage } from '../pages/home/home';
import { TabsPage } from '../pages/tabs/tabs';
import { LoginPage } from '../pages/login/login';
import { DosenMatkulMhsPage } from '../pages/dosen-matkul-mhs/dosen-matkul-mhs';
import { DosenMatkulPage } from '../pages/dosen-matkul/dosen-matkul';
import { ModalPage } from '../pages/dosen-matkul/modal';
import { Modal2Page } from '../pages/dosen-matkul-mhs/modal';
import { Modal3Page } from '../pages/list-todo/modal';
import { TodoPage } from '../pages/todo/todo';
import { ListTodoPage } from '../pages/list-todo/list-todo';

@NgModule({
  declarations: [
    MyApp,
    AboutPage,
    HomePage,
    TabsPage,
    DosenMatkulMhsPage,
    DosenMatkulPage,
    TabsPage,
    ModalPage,
    Modal2Page,
    Modal3Page,
    TodoPage,
    ListTodoPage,
    LoginPage
  ],
  imports: [
    IonicModule.forRoot(MyApp)
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    AboutPage,
    HomePage,
    DosenMatkulMhsPage,
    DosenMatkulPage,
    TabsPage,
    ModalPage,
    Modal2Page,
    Modal3Page,
    TodoPage,
    ListTodoPage,
    LoginPage
  ],
  providers: [{provide: ErrorHandler, useClass: IonicErrorHandler}]
})
export class AppModule {}
