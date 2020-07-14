import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { SignaturePage } from './signature';

@NgModule({
  declarations: [
    //SignaturePage,
  ],
  imports: [
    IonicPageModule.forChild(SignaturePage),
  ],
  schemas: [ CUSTOM_ELEMENTS_SCHEMA ]
})
export class SignaturePageModule {}
