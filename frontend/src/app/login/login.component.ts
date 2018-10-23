import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../modules/core/auth.service';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  loginForm:FormGroup;

  constructor(private fb:FormBuilder, private auth:AuthService, private router:Router) { }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: this.fb.control('',[Validators.required]),
      password: this.fb.control('',[Validators.required])
    });
  }

  onLogin($event) {
    this.auth.setToken('ABCDEFGHIJKLMNOP');
    this.router.navigate(['/dashboard']);
  }

}
