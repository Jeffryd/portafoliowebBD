import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';
// import {RequestOptions, Request, RequestMethod} from '@angular/http';

import 'rxjs/add/operator/do';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';

import { Proyecto } from '.././modelos/proyecto.interface';

@Injectable()
export class ProyectoService {

  private readonly URL = 'http://localhost/BaseDatosCompleta/index.php/';


  constructor(
    public http: HttpClient) { }


  // Funcion para mostrar todos los proyectos
  getProyectos(): Observable<any> {
    // return "Texto desde el servicio";
    return this.http
      .get(this.URL + 'listarproyectos')
      // .do(data => console.log(data))
      .catch(this.handleError);
  }

//Listar categorias
getCategorias(): Observable<any> {
  // return "Texto desde el servicio";
  return this.http
    .get(this.URL + 'listarcategorias')
     .do(data => console.log(data))
    .catch(this.handleError);
}

// funcion para guardar proyectos en BD
addproyecto(proyecto: Proyecto): Observable<any>{
        let json = JSON.stringify(proyecto);
//El backend recogerá un parametro json
        let params = "json="+json;

                //Establecemos cabeceras
        let headers = new HttpHeaders().set('Content-Type','application/x-www-form-urlencoded');

        return this.http.post(this.URL+'addproyectos', params, {headers: headers});

  }

//Subida de imagenes
// upload(formData, id){
// let headers = new HttpHeaders().set('Content-type', 'form-data');
// const options = new RequestOptions({
//   method: RequestMethod.Post,
//   url: this.URL+'subirimagenes'
//   });
// const req = new Request(options);
// console.log('req.method:', RequestMethod[req.method]); // Post
// console.log('options.url:', options.url); // https://google.com
// }

//http://www.bentedder.com/upload-images-angular-4-without-plugin/



  // por cualquier error
  private handleError(err: HttpErrorResponse) {
    console.log(err);
    return Observable.throw(err);
  }


}
