import { DashboardPage } from '../pages/dashboard/dashboard';
import { NgModule, ErrorHandler } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { MyApp } from './app.component';

import { AboutPage } from '../pages/about/about';
import { ContactPage } from '../pages/contact/contact';
import { HomePage } from '../pages/home/home';
import { LoginPage } from '../pages/login/login';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { HistorialPage } from '../pages/historial/historial';
import { SolicitudesProvider } from '../providers/solicitudes/solicitudes';
import { HttpClientModule } from '@angular/common/http';
import { DashboardTeamLeaderPage } from '../pages/dashboard-team-leader/dashboard-team-leader';
import { DashboardTesoreroPage } from '../pages/dashboard-tesorero/dashboard-tesorero';
import { NuevaSolicitudPage } from '../pages/nueva-solicitud/nueva-solicitud';
import { LoginPageModule } from '../pages/login/login.module';
import { HistorialPageModule } from '../pages/historial/historial.module';
import { DashboardTesoreroPageModule } from '../pages/dashboard-tesorero/dashboard-tesorero.module';
import { NuevaSolicitudPageModule } from '../pages/nueva-solicitud/nueva-solicitud.module';
import { DashboardPageModule } from '../pages/dashboard/dashboard.module';
import { SignaturePageModule } from '../pages/signature/signature.module';
import { SignaturePadModule } from 'angular2-signaturepad';
import { SignaturePage } from '../pages/signature/signature';
import { DashboardTeamLeaderPageModule } from '../pages/dashboard-team-leader/dashboard-team-leader.module';
import { Provider } from '../providers/provider/provider';
import { OneSignal } from '@ionic-native/onesignal';
import { PushProvider } from '../providers/push/push';
import { IonicStorageModule } from '@ionic/storage';

@NgModule({
  declarations: [
    MyApp,
    AboutPage,
    ContactPage,
    HomePage
    ,SignaturePage
  ],
  //exports: [ DashboardPage ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp),
    HttpClientModule
    ,LoginPageModule
    ,DashboardPageModule
    ,HistorialPageModule
    ,DashboardTesoreroPageModule
    ,NuevaSolicitudPageModule
    ,SignaturePageModule
    ,SignaturePadModule
    ,DashboardTeamLeaderPageModule
    ,IonicStorageModule.forRoot()
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    AboutPage,
    ContactPage,
    HomePage
    ,LoginPage
    ,DashboardPage
    ,HistorialPage
    ,DashboardTeamLeaderPage
    ,DashboardTesoreroPage
    ,NuevaSolicitudPage
    ,SignaturePage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    SolicitudesProvider
    ,SignaturePadModule
    ,Provider
    ,OneSignal
    ,PushProvider
  ]
})
export class AppModule {}