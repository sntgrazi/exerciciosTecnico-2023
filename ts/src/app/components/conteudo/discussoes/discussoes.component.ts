import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-discussoes',
  templateUrl: './discussoes.component.html',
  styleUrls: ['./discussoes.component.scss']
})
export class DiscussoesComponent implements OnInit {

  constructor() { }

  ngOnInit(): void {
  }

  mostrarFormulario = false; 
  enviadoComSucesso: boolean = false;
  mostrarCard: boolean = false;
  cardExpandido: boolean = false;


  toggleFormulario() {
    this.mostrarFormulario = !this.mostrarFormulario;
  }

  enviarFormulario() {

      this.enviadoComSucesso = true;
      this.mostrarCard = true;
      this.mostrarFormulario = false;
  
  }

  criarOutroTopico() {
   
    this.mostrarFormulario = false;
    this.enviadoComSucesso = false;
    
   
    this.toggleFormulario();
  }

  toggleCardExpandido() {
    this.cardExpandido = !this.cardExpandido;
  }

}
