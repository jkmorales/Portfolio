import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { DashboardTesoreroPage } from './dashboard-tesorero';

@NgModule({
  declarations: [
    DashboardTesoreroPage
  ],
  imports: [
    IonicPageModule.forChild(DashboardTesoreroPage),
  ],
})
export class DashboardTesoreroPageModule {}
