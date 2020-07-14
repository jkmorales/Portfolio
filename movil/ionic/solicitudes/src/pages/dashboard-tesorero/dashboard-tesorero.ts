import { Component } from '@angular/core';
import { IonicPage, NavController, LoadingController } from 'ionic-angular';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { LoginPage } from '../login/login';
import { NuevaSolicitudPage } from '../nueva-solicitud/nueva-solicitud';
import { Provider } from '../../providers/provider/provider';

@IonicPage()
@Component({
  selector: 'page-dashboard-tesorero',
  templateUrl: 'dashboard-tesorero.html',
})

export class DashboardTesoreroPage {

  solicitudes: any[] = [];

  paramsSolicitudes = {
    tipo : ''
  };

  constructor(public navCtrl: NavController,
              public proveedor: SolicitudesProvider,
              public loadingCtrl: LoadingController,
              public provider: Provider) {}

  ionViewDidLoad() {
  }

  logout(){
    this.provider.logout()
    this.navCtrl.setRoot(LoginPage)
  }

  nuevaSolicitud(){
    console.log('ir a página nueva solicitud')
    this.navCtrl.push(NuevaSolicitudPage)
  }

  getSolicitudes(tipo: string){
    this.paramsSolicitudes.tipo = tipo
    this.provider.mostrarSprite('Cargando Información')
    this.navCtrl.push("SolicitudesTesoreroPage", this.paramsSolicitudes)
  }

}
