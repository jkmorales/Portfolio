import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable()
export class SolicitudesProvider {

  public user: any[] = []
  public dashboardProfile:any
  //public url: string = 'http://localhost:8000/api/'
  //public url: string = 'https://inatel.sattori.mx/api/'
  public url: string = 'https://inatel.objetosdeculto.com/api/'

  constructor(public http: HttpClient) {
  }

  login(usser:string, password:string, usserId:string){
    return this.http.post( this.url + 'login',
    {
      email : usser,
      password : password,
      usserId : usserId
    },
    {
      headers: {'Content-Type': 'application/json'}
    })
  }

  obtenerSolicitudes(tipo){
    return this.http.get( this.url + 'request/solicitudes/'+tipo);
  }

  obtenerTodasSolicitudes(){
    return this.http.get( this.url + 'request');
  }

  obtenerSolicitudesPorUsuario(id){
    return this.http.get( this.url + 'request/solicitudesUsuarios/'+id);
  }

  getTeamLeaders(){
    return this.http.get( this.url + 'teamLeaders')
  }

  logout(id:number){
    return this.http.get( this.url + 'logout/' + id)
  }

  autorizarSolicitud(solicitud){
    return this.http.post( this.url + 'request/autorizar/'+solicitud.id,
    {
      observaciones : solicitud.observaciones,
      monto : solicitud.monto
    },
    {
      headers: {'Content-Type': 'application/json'}
    });
  }

  firmarSolicitud(solicitud:any){
    return this.http.post( this.url + 'request/firmar',
    {
      solicitud : solicitud
    },
    {
      headers: {'Content-Type': 'application/json'}
    })
  }

  editarSolicitud(id,monto,observaciones){
    return this.http.post( this.url + 'request/solicitudes/'+id,
    {
      observaciones : observaciones,
      monto : monto 
    },
    {
      headers: {'Content-Type': 'application/json'}
    }
    );
  }

  crearSolicitud(solicitud:any){
    return this.http.post( this.url + 'request',
    {
      observaciones : solicitud.observaciones,
      monto : solicitud.monto,
      fkUser : solicitud.fkUser,
      fkOt : parseInt(solicitud.fkOt)
    },
    {
      headers: {'Content-Type': 'application/json'}
    }
    )
  }

  //@todo - Enviar solo a perfil PMO
  sendPushNotification(solicitud:any){
    return this.http.post('https://onesignal.com/api/v1/notifications',
    {
      "app_id": "16e6e9f6-6417-417c-960e-dd8eb00d502a",
      "headings" : {"en":"📡 Nueva Solicitud - Caja Chica 💰"},
      "contents" : {"en" : " OT" + solicitud.fkOt + " - $" + solicitud.monto},
      "include_player_ids" : [ solicitud.usserId ]
      // "include_player_ids" : ["a6862434-0761-4dd7-b261-695530eb9c32"]
      //"included_segments" : ["Active Users", "Inactive Users"],
      //"data": { "user:id" : "POSTman-12345"},
      // "contents" : { "en" : "English message since Postman" , 
      //                "es" : "Mensaje español desde postman"},
    },
    {
      headers: {
        'Content-Type': 'application/json',
        'Authorization' : 'Basic ZThhNDM2YmYtOTVkOC00ZTAxLWI2ZDMtOWZkYmNhNjBmOGQz'
      }
    })
  }

  isLoggedPMO(){
    return this.http.get( this.url + 'isLoggedPMO')
  }

}