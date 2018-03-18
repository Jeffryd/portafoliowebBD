import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

mostrarMenu: boolean;

  constructor() { }

  ngOnInit() {
  }

  OultarMenu():void{
    this.mostrarMenu=false;
  }

  activarMenu():void{
    this.mostrarMenu=true;
  }

}
