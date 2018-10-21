import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';


@Injectable()
export class AuthService {

  constructor(private http:HttpClient) {

  }

  public login(username:string, password:string):Observable<any> {
    return this.http.post('/account/login', {username:username, password:password} );
  }

  public loginSuccess(result) {
    console.log(result);
  }

  public logout() {
    return this.http.post('/account/logout', {});
  }

}

