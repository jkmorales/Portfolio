import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { LoadingController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { SolicitudesProvider } from '../solicitudes/solicitudes';

@Injectable()
export class Provider {

  public perfil:string = 'Solicitudes'
  public user_name:string  = 'Inatel'
  public paterno:string = ''
  public userId:number

  constructor(public http: HttpClient,
              public loadingCtrl: LoadingController,
              private storage: Storage,
              private provider: SolicitudesProvider) {

    this.initializeData()

              }

  async initializeData()              {
    await this.storage.get('user').then((val) => {
      //console.log(val)
      this.perfil = val.perfil
      this.user_name = val.name
      this.paterno = val.paterno
      this.userId = val.id
    });
  }

  storageUser(user:any){
    this.user_name = user.name
    this.paterno = user.paterno
    this.perfil = user.perfil
    this.userId = user.id
  }

  logout(){
    this.storage.remove('user')
    this.storage.clear()
    this.mostrarSprite('Cerrando sesión')
    this.provider.logout(this.userId)
    .subscribe( (data)  => {
      console.log(data)
    })
  }

  mostrarSprite(message:string){
    const loader = this.loadingCtrl.create({
      content: message,
      duration: 600
    });

    loader.present();    
  }

}
