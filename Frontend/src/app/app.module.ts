import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { MyComponentComponent } from './my-component/my-component.component';
import { Impression3DComponent } from './impression3-d/impression3-d.component';
import { AuthComponent } from './auth/auth.component';
import { Routes,RouterModule } from '@angular/router';
import { GalerieComponent } from './galerie/galerie.component';
import { AcceuilComponent } from './acceuil/acceuil.component';
import { FormationsComponent } from './formations/formations.component';
import { EquipeComponent } from './equipe/equipe.component';
import { ContactComponent } from './contact/contact.component';
import { CalendrierComponent } from './calendrier/calendrier.component';
import { ActivitesComponent } from './activites/activites.component';

const appRoutes: Routes = [
  {path: 'Impression3D', component: Impression3DComponent},
  {path: '', component: AcceuilComponent},
  {path: 'Galerie', component: GalerieComponent},
  {path: 'Activites', component: ActivitesComponent},
  {path: 'Calendrier', component: CalendrierComponent},
  {path: 'Contact', component: ContactComponent},
  {path: 'Equipe', component: EquipeComponent},
  {path: 'Formations', component: FormationsComponent}
];
@NgModule({
  declarations: [
    AppComponent,
    MyComponentComponent,
    Impression3DComponent,
    AuthComponent,
    GalerieComponent,
    AcceuilComponent,
    FormationsComponent,
    EquipeComponent,
    ContactComponent,
    CalendrierComponent,
    ActivitesComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
