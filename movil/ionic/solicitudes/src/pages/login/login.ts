import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, LoadingController, AlertController } from 'ionic-angular';
import { DashboardPage } from '../dashboard/dashboard';
import { SolicitudesProvider } from '../../providers/solicitudes/solicitudes';
import { DashboardTeamLeaderPage } from '../dashboard-team-leader/dashboard-team-leader';
import { DashboardTesoreroPage } from '../dashboard-tesorero/dashboard-tesorero';
import { MenuController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { Provider } from '../../providers/provider/provider';
import { PushProvider } from '../../providers/push/push';

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})

export class LoginPage {

  solicitudes: any[] = []

  constructor(public navCtrl: NavController,
              public navParams: NavParams, 
              public loadingCtrl: LoadingController, 
              public alertCtrl: AlertController,
              public provedor: SolicitudesProvider,
              public menuCtrl: MenuController,
              private storage: Storage,
              private provider: Provider,
              private pushService: PushProvider) {}

  ionViewDidLoad() {
    this.menuCtrl.enable(false)
    this.isUsserLogged()
  }

  async isUsserLogged(){
    await this.storage.get('user').then((val) => {
      if(val != null){
        this.redirectDashboard(val.pkPerfil)
      }
    })
  }

  login(usser:string = '', password:string = ''){
    this.mostrarSprite();
    this.provedor.login(usser,password, this.pushService.userId)
    .subscribe(
      (data) => {
        if(data['status'] == 'Success'){
          this.provider.storageUser(data['data'].user)
          this.storage.set('user', data['data'].user)
          setTimeout(() => {
            switch( data['data'].user.fkPerfil )
            {
              case 1 : //Ninja - Administrador
                //@todo make another dashboard
                this.provedor.dashboardProfile = DashboardPage
                this.navCtrl.setRoot(DashboardPage)
                break;
              case 2: //Project Managment
                this.provedor.dashboardProfile = DashboardPage
                this.navCtrl.setRoot(DashboardPage)
                break;
              case 3: //Team Leader
                this.provedor.dashboardProfile = DashboardTeamLeaderPage
                this.navCtrl.setRoot(DashboardTeamLeaderPage)
                break;
              case 4: //Tesorero
                this.provedor.dashboardProfile = DashboardTesoreroPage
                this.navCtrl.setRoot(DashboardTesoreroPage)
                break;
              default:
                this.showError(data['message'])
                this.navCtrl.setRoot(LoginPage);
            } 
          }, 2200); 
        } else {
           this.showError(data['message'])
        }
      },error =>{
        this.showError('Estas credenciales no concuerdan con nuestros registros')
      }
    );
  } 

  mostrarSprite(){
    const loader = this.loadingCtrl.create({
      content: "Logueando .  .   .",
      duration: 2200
    });

    loader.present();
  }

  showError(message:string){
    setTimeout(() => {
      const alert = this.alertCtrl.create({
        title: 'Error - 💀',
        message: message,
        buttons: ['OK']
      });
      alert.present();
    }, 2200);
  }

  redirectDashboard(profile:any){
    switch(Number(profile))
            {
              case 1 : //Ninja - Administrador
                this.navCtrl.setRoot(DashboardPage)
                break;
              case 2: //Project Managment
                this.navCtrl.setRoot(DashboardPage)
                break;
              case 3: //Team Leader
                this.navCtrl.setRoot(DashboardTeamLeaderPage)
                break;
              case 4: //Tesorero
                this.navCtrl.setRoot(DashboardTesoreroPage)
                break;
              default:
                this.navCtrl.setRoot(LoginPage);
            }
  }

}