import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { DashboardTeamLeaderPage } from './dashboard-team-leader';

@NgModule({
  declarations: [
    DashboardTeamLeaderPage
  ],
  imports: [
    IonicPageModule.forChild(DashboardTeamLeaderPage),
  ],
})
export class DashboardTeamLeaderPageModule {}