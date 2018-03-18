import { Pipe, PipeTransform } from '@angular/core';
import { Proyecto } from '../portafolio/modelos/proyecto.interface';

@Pipe({name: 'filtroCategoria'})
export class CategoriaPipe implements PipeTransform {
  transform(value: Proyecto[], categoria: string): Proyecto[] {
    if (!value) {
      return [];
    }
    const proyectosFiltrados = value.filter((proyecto: Proyecto) => proyecto.categoria === categoria);
    return proyectosFiltrados;
  }
}
