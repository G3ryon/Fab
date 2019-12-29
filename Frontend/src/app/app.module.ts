import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
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
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatSidenavModule} from "@angular/material/sidenav";
import { FooterComponent } from './components/footer/footer.component';
import { SideNavbarComponent } from './components/side-navbar/side-navbar.component';
import { HeaderComponent } from './components/header/header.component';
import { MapComponent } from './components/map/map.component';
import { AgmCoreModule } from '@agm/core';
import { DayPrintFormComponent } from './components/day-print-form/day-print-form.component';
import {MatInputModule} from "@angular/material/input";
import {MatDatepickerModule} from "@angular/material/datepicker";
import {DateAdapter, MatNativeDateModule} from "@angular/material/core";
import { HttpClientModule } from '@angular/common/http';
import {MatButtonModule} from "@angular/material/button";
import { PrintFormComponent } from './components/print-form/print-form.component';
import {FormsModule} from "@angular/forms";
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { AdminComponent } from './admin/admin.component';

const appRoutes: Routes = [
  {path: 'Impression3D', component: Impression3DComponent},
  {path: '', component: AcceuilComponent},
  {path: 'Galerie', component: GalerieComponent},
  {path: 'Activites', component: ActivitesComponent},
  {path: 'Calendrier', component: CalendrierComponent},
  {path: 'Contact', component: ContactComponent},
  {path: 'Equipe', component: EquipeComponent},
  {path: 'Formations', component: FormationsComponent},
  {path: 'Admin', component: AdminComponent}
];
@NgModule({
  declarations: [
    AppComponent,
    Impression3DComponent,
    AuthComponent,
    GalerieComponent,
    AcceuilComponent,
    FormationsComponent,
    EquipeComponent,
    ContactComponent,
    CalendrierComponent,
    ActivitesComponent,
    FooterComponent,
    SideNavbarComponent,
    HeaderComponent,
    MapComponent,
    DayPrintFormComponent,
    PrintFormComponent,
    AdminComponent,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    RouterModule.forRoot(appRoutes),
    BrowserAnimationsModule,
    MatSidenavModule,
    BrowserModule,
    NgbModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyD0JuQI2Xlse-LCqg9LDKimnTVT8t2JH7c'
    }),
    MatInputModule,
    MatDatepickerModule,
    MatNativeDateModule,
    HttpClientModule,
    MatButtonModule,
    FormsModule

  ],
  providers: [MatDatepickerModule,MatNativeDateModule],
  bootstrap: [AppComponent]
})
export class AppModule { }
