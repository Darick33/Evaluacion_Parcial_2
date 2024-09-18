import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Iproveedor } from '../Interfaces/iproveedor';

@Injectable({
  providedIn: 'root'
})
export class ProveedorService {
  apiurl = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/controllers/proveedores.controller.php?op=';

  constructor(private lector: HttpClient) {}

  todos(): Observable<Iproveedor[]> {
    return this.lector.get<Iproveedor[]>(this.apiurl + 'todos');
  }
  uno(idProveedor: number): Observable<Iproveedor> {
    const formData = new FormData();
    formData.append('idProveedores', idProveedor.toString());
    return this.lector.post<Iproveedor>(this.apiurl + 'uno', formData);
  }
  eliminar(idProveedor: number): Observable<number> {
    const formData = new FormData();
    formData.append('idProveedores', idProveedor.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }
  insertar(proveedor: Iproveedor): Observable<string> {
    const formData = new FormData();
    formData.append('Nombre_Empresa', proveedor.Nombre_Empresa);
    formData.append('Direccion', proveedor.Direccion);
    formData.append('Telefono', proveedor.Telefono);
    formData.append('Contacto_Empresa', proveedor.Contacto_Empresa);
    formData.append('Teleofno_Contacto', proveedor.Teleofno_Contacto);
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }
  actualizar(proveedor: Iproveedor): Observable<string> {
    const formData = new FormData();
    formData.append('idProveedores', proveedor.idProveedores.toString());
    formData.append('Nombre_Empresa', proveedor.Nombre_Empresa);
    formData.append('Direccion', proveedor.Direccion);
    formData.append('Telefono', proveedor.Telefono);
    formData.append('Contacto_Empresa', proveedor.Contacto_Empresa);
    formData.append('Teleofno_Contacto', proveedor.Teleofno_Contacto);
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
