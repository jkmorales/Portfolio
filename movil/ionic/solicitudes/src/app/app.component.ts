import { Component, ViewChild } from '@angular/core';
import { Platform, NavController } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { LoginPage } from '../pages/login/login';
import { HistorialPage } from '../pages/historial/historial';
import { Provider } from '../providers/provider/provider';
import { PushProvider } from '../providers/push/push';

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  rootPage:any = LoginPage;

  @ViewChild('content') nav: NavController;

  constructor(private platform: Platform,
              private statusBar: StatusBar,
              private splashScreen: SplashScreen,
              public provider: Provider,
              private pushService: PushProvider
  ) {
      this.initializeApp()
  }

  initializeApp(){
    this.platform.ready().then(() => {
      this.statusBar.styleDefault();
      this.splashScreen.hide();
      this.pushService.configuracionInicial();
    });
  }

  historial(){
    this.nav.setRoot(HistorialPage);
  }

  logout(){
    this.provider.logout()
    this.nav.setRoot(LoginPage)
  }
}
