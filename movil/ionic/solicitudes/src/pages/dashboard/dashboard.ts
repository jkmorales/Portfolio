import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController, AlertController } from 'ionic-angular';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { MenuController } from 'ionic-angular';
import { Provider } from '../../providers/provider/provider';
import { PushProvider } from '../../providers/push/push';

@IonicPage()
@Component({
  selector: 'page-dashboard',
  templateUrl: 'dashboard.html',
})
export class DashboardPage {

  solicitudes: any[] = []

  constructor(public navCtrl: NavController, 
              public navParams: NavParams, 
              public loadingCtrl: LoadingController,
              public alertCtrl: AlertController,
              public proveedor: SolicitudesProvider,
              public menuCtrl: MenuController,
              public provider: Provider,
              public pushService: PushProvider) {

      this.getSolicitudes()

  }

  ionViewDidLoad() {
    this.menuCtrl.enable(true)
    this.getSolicitudes()
  }

  editar(solicitud){
    const confirm = this.alertCtrl.create({
      title: '$ ' + solicitud.monto,
      subTitle: solicitud.name + ' ' + solicitud.paterno + ' ' + solicitud.materno,
      message: 'Modificar monto',
      inputs:[
        {
          name: 'monto',
          placeholder: '$ ' + solicitud.monto
        },
        {
          name: 'observaciones',
          placeholder: 'observaciones'
        }
      ],
      buttons: [
        {
          text: 'Cancelar',
          handler: () => {
            console.log('Disagree clicked');
          }
        },
        {
          text: 'Editar',
          handler: data => {
            this.mostrarSprite();
            console.log('Editar');
            this.proveedor.editarSolicitud(solicitud.id,data.monto,data.observaciones)
            .subscribe(
              (data) => {
                console.log('ok');
                this.navCtrl.setRoot(DashboardPage);
              },error =>{
                 console.log(error);  
              }
            )
          }
        }
      ]
    });
    confirm.present();
  }

  autorizar(solicitud){
    let confirm = this.alertCtrl.create({
      title: '$ ' + solicitud.monto + ' | OT: ' + solicitud.ot,
      subTitle: solicitud.name + ' ' + solicitud.paterno + ' ' + solicitud.materno,
      message: solicitud.observaciones + ' | ' + solicitud.creada,
      buttons: [
        {
          text: 'Cancelar',
          handler: () => {
            console.log('Denegar');
          }
        },
        {
          text: 'Autorizar',
          handler: () => {
            this.mostrarSprite();
            console.log('Autorizar');
            this.proveedor.autorizarSolicitud(solicitud)
            .subscribe(
              (data) => {
                console.log('ok');
                this.navCtrl.setRoot(DashboardPage);
              },error =>{
                 console.log(error);  
              }
            )
          }
        }
      ]
    });
    confirm.present();
  }

  mostrarSprite(){
    const loader = this.loadingCtrl.create({
      content: "Guardando Información",
      duration: 2200
    });

    loader.present();    
  }

  doRefresh(refresher:any) {

    this.getSolicitudes()

    setTimeout(() => {
      console.log('Sincronización hecha correctamente');
      refresher.complete();
    }, 1000);
  }

  getSolicitudes(){
    this.proveedor.obtenerSolicitudes('generadas')
    .subscribe(
      (data) =>{
      this.solicitudes = data['data'].solicitudes;
    })
  }
}