import { Component, OnInit } from '@angular/core';
import { AuthService } from '../modules/core/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(private auth:AuthService, private router:Router) { }

  ngOnInit() {
  }

  onLogout($event) {
    this.auth.clearToken();
    this.router.navigate(['/login']);
  }

}
