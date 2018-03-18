import { Component, OnInit } from '@angular/core';
import { Proyecto } from '../../modelos/proyecto.interface';
import {ProyectoService} from '../../servicios/proyecto.service';

@Component({
  selector: 'app-categorias',
  templateUrl: './categorias.component.html',
  styleUrls: ['./categorias.component.css']
})
export class CategoriasComponent implements OnInit {


public categorias: Proyecto[];

  constructor() { }

  ngOnInit() {



  }

}
