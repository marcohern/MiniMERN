import { Component, OnInit } from '@angular/core';
import { AuthService } from '../modules/auth/auth.service';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.css']
})
export class MenuComponent implements OnInit {

  constructor(private auth:AuthService) { }

  ngOnInit() {
  }

}
