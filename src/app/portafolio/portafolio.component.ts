import { Component, OnInit } from '@angular/core';
import {Router, ActivatedRoute, Params} from '@angular/router';
import {ProyectoService} from './servicios/proyecto.service';
import { Proyecto } from './modelos/proyecto.interface';

@Component({
  selector: 'app-portafolio',
  templateUrl: './portafolio.component.html',
  styleUrls: ['./portafolio.component.css']
})
export class PortafolioComponent implements OnInit {
  titulo = 'Listado de Proyectos';
  proyectos: Proyecto[];

  constructor(private _ProyectoService: ProyectoService) { }

  ngOnInit() {
    console.log('app-portafolio.component.ts cargado');
    // alert(this._ProyectoService.getProyectos());

    this._ProyectoService.getProyectos().subscribe(
      result => this.proyectos = result.data,
      error => console.log(error)
    )
  }
}
