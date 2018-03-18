import { Component, OnInit, Input } from '@angular/core';
import { Proyecto } from '../modelos/proyecto.interface';

@Component({
  selector: 'app-proyecto',
  templateUrl: './proyecto.component.html',
  styleUrls: ['./proyecto.component.css']
})
export class ProyectoComponent implements OnInit {

  @Input() proyectos: Proyecto[];

  constructor() { }

  ngOnInit() {
  }

}
