import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Policy } from './policy';

import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root'
})
export class ApiService {
  PHP_API_SERVER = 'http://localhost:8000';

  constructor(private http: HttpClient) { }

  readPolicies(): Observable<Policy[]> {
    return this.http.get<Policy[]>(`${this.PHP_API_SERVER}/api/reads.php`);
  }

  createPolicy(policy: Policy): Observable<Policy> {
    return this.http.post<Policy>(`${this.PHP_API_SERVER}/api/create.php`, policy);
  }

  updatePolicy(policy: Policy) {
    return this.http.put<Policy>(`${this.PHP_API_SERVER}/api/update.php`, policy);
  }
  deletePolicy(id: number){
    return this.http.delete<Policy>(`${this.PHP_API_SERVER}/api/delete.php/?id=${id}`);
  }
}

