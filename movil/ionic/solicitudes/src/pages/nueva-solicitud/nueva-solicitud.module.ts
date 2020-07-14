import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { NuevaSolicitudPage } from './nueva-solicitud';

@NgModule({
  declarations: [
    NuevaSolicitudPage,
  ],
  imports: [
    IonicPageModule.forChild(NuevaSolicitudPage),
  ],
})
export class NuevaSolicitudPageModule {}
