import { Component, ViewChild  } from '@angular/core';
import { IonicPage, NavController, NavParams, ViewController, LoadingController, ToastController  } from 'ionic-angular';
import { SignaturePad } from 'angular2-signaturepad/signature-pad';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { DashboardTesoreroPage } from '../dashboard-tesorero/dashboard-tesorero';

@IonicPage()
@Component({
  selector: 'page-signature',
  templateUrl: 'signature.html',
})
export class SignaturePage {

  @ViewChild(SignaturePad) public signaturePad : SignaturePad;

  public signaturePadOptions : Object = {
    'minWidth': 2,
    'canvasWidth': 340,
    'canvasHeight': 200
  };

  public signatureImage : string
  public solicitudSignature : any
  public solicitud : any

  constructor(public navCtrl: NavController,
              public navParams: NavParams,
              public viewCtrl: ViewController,
              public proveedor: SolicitudesProvider,
              public loadingCtrl: LoadingController,
              public toastCtrl: ToastController
              ) {

    this.solicitud = navParams.get('solicitud')
  }

  ionViewDidLoad() {
    console.log(this.solicitud)

    
      setTimeout(() => {
        console.log('signature pad', this.signaturePad);
      }, 1000);
    
  }

  drawCancel() {
    this.viewCtrl.dismiss()
  }

   drawComplete() {
    this.signatureImage = this.signaturePad.toDataURL();
    console.log(this.signatureImage)
    this.mostrarSprite()
    this.solicitudSignature = {
      id : this.solicitud.id,
      firma : this.signatureImage
    }

    this.proveedor.firmarSolicitud(this.solicitudSignature)
    .subscribe(
      (data) => {
        console.log(data)
        this.viewCtrl.dismiss()
        this.messageToast('Solicitud Firmada Correctamente')
        this.navCtrl.setRoot(DashboardTesoreroPage);
      }
    )
  }

  drawClear() {
    this.signaturePad.clear();
  }

  canvasResize() {
    let canvas = document.querySelector('canvas');
    this.signaturePad.set('minWidth', 1);
    this.signaturePad.set('canvasWidth', canvas.offsetWidth);
    this.signaturePad.set('canvasHeight', canvas.offsetHeight);
  }

  ngAfterViewInit() {
        this.signaturePad.clear();
        this.canvasResize();
  }

  mostrarSprite(){
    const loader = this.loadingCtrl.create({
      content: "Firmando .  .   .",
      duration: 2200
    });

    loader.present();
  }

  async messageToast(message:string) {
    console.log(message)
    const toast = await this.toastCtrl.create({
      message: message,
      duration: 5000
    })
    await toast.present();
  }

}
