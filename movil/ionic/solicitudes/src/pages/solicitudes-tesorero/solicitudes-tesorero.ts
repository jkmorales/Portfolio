import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ModalController } from 'ionic-angular';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { LoginPage } from '../login/login';
import { SignaturePage } from '../signature/signature'
import { Provider } from '../../providers/provider/provider';

@IonicPage()
@Component({
  selector: 'page-solicitudes-tesorero',
  templateUrl: 'solicitudes-tesorero.html',
})
export class SolicitudesTesoreroPage {

  public solicitudes : any[] = [];
  public tipo : string;
  public signatureImage : any
  signaturePage = 'SignaturePage'

  paramsSolicitudes = {
    solicitud : ''
  };

  constructor(public navCtrl: NavController,
              public navParams: NavParams,
              public proveedor: SolicitudesProvider,
              public modalController:ModalController,
              public provider: Provider ){

    this.tipo = navParams.get("tipo")
    this.signatureImage = navParams.get('signatureImage')
    this.getSolicitudes()

    }

  ionViewDidLoad() {
    
    this.getSolicitudes()
    
  }

  firmar(solicitud:any){
    if(solicitud.pkRecordStatus === 6)
    {
      this.paramsSolicitudes.solicitud = solicitud
      this.openSignatureModel()
    } else {
      console.log('modal solicitud')
    }
  }

  logout(){
    this.provider.logout()
    this.navCtrl.setRoot(LoginPage)
  }

  openSignatureModel(){
    setTimeout(() => {
       let modal = this.modalController.create(SignaturePage,this.paramsSolicitudes);
       modal.present();
    }, 300);

  }

  doRefresh(refresher:any) {

    this.getSolicitudes()

    setTimeout(() => {
      console.log('Sincronización hecha correctamente');
      refresher.complete();
    }, 1000);
  }

  getSolicitudes(){

    this.proveedor.obtenerSolicitudes(this.tipo)
    .subscribe(
      (data) => {
        this.solicitudes = data['data'].solicitudes;
        console.log(this.solicitudes)
      }
    )

  }

}