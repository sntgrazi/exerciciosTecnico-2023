import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { ConteudoComponent } from './components/conteudo/conteudo.component';
import { BoxEsquerdoComponent } from './components/conteudo/box-esquerdo/box-esquerdo.component';
import { BoxDireitoComponent } from './components/conteudo/box-direito/box-direito.component';
import { ResumoComponent } from './components/conteudo/resumo/resumo.component';
import { DiscussoesComponent } from './components/conteudo/discussoes/discussoes.component';
import { CardComponent } from './components/conteudo/discussoes/card/card.component';
import { FooterComponent } from './components/footer/footer.component';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    AppComponent,
    SidebarComponent,
    NavbarComponent,
    ConteudoComponent,
    BoxEsquerdoComponent,
    BoxDireitoComponent,
    ResumoComponent,
    DiscussoesComponent,
    CardComponent,
    FooterComponent
  ],
  imports: [
    BrowserModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
