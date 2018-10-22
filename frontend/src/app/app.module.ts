import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CoreModule } from './modules/core/core.module';
import { UsersModule } from './modules/users/users.module';
import { RouterModule } from '@angular/router';

import { AppComponent } from './app.component';
import { routes } from './app-routes';
import { MenuComponent } from './menu/menu.component';

@NgModule({
  declarations: [
    AppComponent,
    MenuComponent
  ],
  imports: [
    BrowserModule,
    CoreModule,
    UsersModule,
    RouterModule.forRoot(routes)
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
