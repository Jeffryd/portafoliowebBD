import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule, } from '@angular/common/http';
// import { RequestOptions, Request, RequestMethod } from '@angular/http';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { InicioComponent } from './inicio/inicio.component';
import { PortafolioComponent } from './portafolio/portafolio.component';


import { CurriVitComponent } from './curri-vit/curri-vit.component';
import { BiografiaComponent } from './biografia/biografia.component';
import { ContactoComponent } from './contacto/contacto.component';
import { FooterComponent } from './footer/footer.component';

//--servicios
import {ProyectoService} from './portafolio/servicios/proyecto.service';
import { CategoriaPipe } from './pipes/categoria.pipe';
import { ProyectoComponent } from './portafolio/proyectos-filtrados/proyecto.component';
import { EditarproyectoComponent } from './portafolio/editarproyecto/editarproyecto.component';
import { CategoriasComponent } from './portafolio/proyectos-filtrados/categorias/categorias.component'

//--Rutas Pricipales
const appRoutes: Routes = [
  { path: '', component: InicioComponent },
  { path: 'portafolio',   component: PortafolioComponent},
  { path: 'editarproyecto',   component: EditarproyectoComponent},
  { path: 'cv',      component: CurriVitComponent },
  { path: 'biografia',      component: BiografiaComponent },
  { path: 'contacto',      component: ContactoComponent },

  { path: '**', component: InicioComponent }
];

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    InicioComponent,
    PortafolioComponent,
    CurriVitComponent,
    BiografiaComponent,
    ContactoComponent,
    FooterComponent,
    CategoriaPipe,
    ProyectoComponent,
    EditarproyectoComponent,
    CategoriasComponent
  ],

  imports: [
    BrowserModule,
    NgbModule.forRoot(),
    FormsModule,
    HttpClientModule,
    // RequestOptions,
    RouterModule.forRoot(appRoutes)
  ],
  providers: [ProyectoService],
  bootstrap: [AppComponent]
})
export class AppModule { }
