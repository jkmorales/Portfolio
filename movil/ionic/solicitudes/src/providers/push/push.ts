import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { OneSignal } from '@ionic-native/onesignal';
import { Storage } from '@ionic/storage';

@Injectable()
export class PushProvider {

  userId:string = ''

  constructor(public http: HttpClient,
              private oneSignal: OneSignal,
              private storage: Storage) {}

  configuracionInicial(){
    this.oneSignal.startInit('16e6e9f6-6417-417c-960e-dd8eb00d502a','546129665169');

    //this.oneSignal.inFocusDisplaying(this.oneSignal.OSInFocusDisplayOption.InAppAlert);
    this.oneSignal.inFocusDisplaying(this.oneSignal.OSInFocusDisplayOption.Notification);

    this.oneSignal.handleNotificationReceived().subscribe(( noti ) => {
      console.log('notificación recibida', noti)
    });

    this.oneSignal.handleNotificationOpened().subscribe(( noti ) => {
      console.log('notificación abierta', noti)
    });

    //Obtener id del suscriptor
    this.oneSignal.getIds().then( info => {
      this.userId = info.userId
      console.log(this.userId)
      this.storage.set('userId_OS', this.userId)
    })

    this.oneSignal.endInit();
  }

}
