import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController, AlertController, ToastController } from 'ionic-angular';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { DashboardTesoreroPage } from '../dashboard-tesorero/dashboard-tesorero';

@IonicPage()
@Component({
  selector: 'page-nueva-solicitud',
  templateUrl: 'nueva-solicitud.html',
})
export class NuevaSolicitudPage {

  team_leaders:any = []
  fkUser:number = 0
  ot:string = ''
  observaciones:string = ''
  monto:number = 0
  solicitud:any

  constructor(public navCtrl: NavController,
              public navParams: NavParams,
              public loadingCtrl: LoadingController,
              public proveedor: SolicitudesProvider,
              private alertCtrl: AlertController,
              private toastCtrl: ToastController) {
  }

  ionViewDidLoad() {
    this.proveedor.getTeamLeaders()
    .subscribe((data) => {
      this.team_leaders = data['data']['teamLeaders']
    })
  }

  generarSolicitud(){
    this.mostrarSprite("Generando Solicitud")

    if(this.validate()){
      this.solicitud = {
        observaciones : this.observaciones,
        monto : this.monto,
        fkUser : this.fkUser,
        fkOt : parseInt(this.ot),
        usserId : ''
      }                 
      console.log(this.solicitud)
  
      this.proveedor.crearSolicitud(this.solicitud)
      .subscribe((data) => {
        console.log(data)
        if(data['status'] === 'Success'){
          this.presentToast()
          this.navCtrl.setRoot(DashboardTesoreroPage)
          this.sendPushNotificationPMO(this.solicitud)  
        }
      })
    } else {
      this.showAlert('Atención','Debe llenar todos los campos marcados con  *', 'OK')
    }
  }

  cancelar(){
    console.log('Cancelar')
    this.navCtrl.setRoot(DashboardTesoreroPage)
  }

  mostrarSprite(message:string){
    const loader = this.loadingCtrl.create({
      content: message,
      duration: 500
    });

    loader.present();    
  }

  processForm(event:any){
      console.log(event)
  }

  onSelect(){
    //console.log('id Team Leader: ' + this.fkUser)
  }

  validate(){
    return (this.fkUser != 0 &&
            this.monto > 0 &&
            this.ot != '')
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

  presentToast() {
    let toast = this.toastCtrl.create({
      message: 'Solicitud Generada Correctamente',
      duration: 3000,
      position: 'top'
    });
  
    toast.onDidDismiss(() => {
      //console.log('Dismissed toast');
    });
  
    toast.present();
  }

  sendPushNotificationPMO(solicitud:any){ 

    this.proveedor.isLoggedPMO()
    .subscribe( ( value ) => {
      if(value['status'] == 'Success'){
        solicitud.usserId = value['data'].player_id
        console.log('Send Push Notification')
        this.proveedor.sendPushNotification(solicitud)
        .subscribe((data) => {
          console.log(data)
        })
      }
    })

  }

}
