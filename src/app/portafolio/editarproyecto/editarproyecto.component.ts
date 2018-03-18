import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, Params } from '@angular/Router';

import { ProyectoService } from '../../portafolio/servicios/proyecto.service';
import { Proyecto } from '../../portafolio/modelos/proyecto.interface';

@Component({
  selector: 'app-editarproyecto',
  templateUrl: './editarproyecto.component.html',
  styleUrls: ['./editarproyecto.component.css']
})
export class EditarproyectoComponent implements OnInit {


//Variable donde almaceno las categorias
public categorias: Proyecto[];
public proyecto: Proyecto;

  constructor(
    public _proyectoService: ProyectoService ) {
  this.proyecto = new Proyecto('', 0, '', '', '' , '' , '' , '', 0 , 0 ); }


  ngOnInit() {
    //Mostrar las categorias
    this._proyectoService.getCategorias().subscribe(
      result => this.categorias = result.data,
      error => console.log(error)
    );

//Subida de imagenes

  }
  onsubmit() {
    console.log('_proyectoService.listarcategorias');


//Agregar proyectos
    console.log(this.proyecto);
    this._proyectoService.addproyecto(this.proyecto).subscribe(
      result => console.log(result),
      error => console.log(error)
    );
  }
}
