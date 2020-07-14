import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { LoginPage } from '../login/login';
import { Provider } from '../../providers/provider/provider';
import { Storage } from '@ionic/storage';

@Component({
  selector: 'page-dashboard-team-leader',
  templateUrl: 'dashboard-team-leader.html',
})
export class DashboardTeamLeaderPage {

  solicitudes: any[] = []
  user_id:number

  constructor(public navCtrl: NavController, 
              public navParams: NavParams,
              public proveedor: SolicitudesProvider,
              public provider: Provider,
              private storage: Storage) {

    this.getSolicitudes()

  }

  ionViewDidLoad() {
    
    this.getSolicitudes()
    
  }

  logout(){
    this.provider.logout()
    this.navCtrl.setRoot(LoginPage)
  }

  doRefresh(refresher:any) {

    this.getSolicitudes()

    setTimeout(() => {
      console.log('Sincronización hecha correctamente');
      refresher.complete();
    }, 1000);
  }

  async getSolicitudes(){
    this.proveedor.obtenerSolicitudesPorUsuario(this.user_id)
    .subscribe(
      (data) => {
        this.solicitudes = data['data'].solicitudes;
      })

    this.getUserId()
  }

  async getUserId(){
    await this.storage.get('user').then((val) => {
      this.user_id = val.id
    });
  }

}

