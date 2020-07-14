import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, AlertController } from 'ionic-angular';
import { DashboardPage } from '../dashboard/dashboard';
import { SolicitudesProvider} from '../../providers/solicitudes/solicitudes';

@IonicPage()
@Component({
  selector: 'page-historial',
  templateUrl: 'historial.html',
})
export class HistorialPage {

  solicitudes: any[] = [];

  constructor(public navCtrl: NavController, 
              public navParams: NavParams,
              public proveedor: SolicitudesProvider,
              private alertCtrl: AlertController) {}

  ionViewDidLoad() {
    
    this.getSolicitudes()
    
  }

  dashboard(){
    this.navCtrl.setRoot(DashboardPage);
  }

  filtro(){
    console.log('Función de filtro solo está disponible en versión premium')
    this.showAlert('Atención','Función de filtro solo está disponible en versión premium','OK')
  }

  async showAlert(header:string,message:string,button:string){
    console.log(header + ' - ' + message)
      setTimeout(async() => {
        const alert = await this.alertCtrl.create({
          title: header,
          message: message,
          buttons: [button]
        });
         await alert.present();
      }, 1)
  }

  doRefresh(refresher:any) {

    this.getSolicitudes()

    setTimeout(() => {
      console.log('Sincronización hecha correctamente');
      refresher.complete();
    }, 1000);
  }

  getSolicitudes(){
    this.proveedor.obtenerTodasSolicitudes()
    .subscribe(
      (data) => {
        this.solicitudes = data['data'].solicitudes;
      }
    )
  }

}
  