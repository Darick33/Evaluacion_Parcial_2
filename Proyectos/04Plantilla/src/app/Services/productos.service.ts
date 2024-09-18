import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { IProducto } from '../Interfaces/iproducto'; // Asegúrate de crear esta interfaz
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductoService {
  apiurl = 'http://localhost/Sexto/gias2/Sexto/Proyectos/03MVC/controllers/productos.controller.php?op=';

  constructor(private http: HttpClient) {}

  // Método para obtener todos los productos
  todos(): Observable<IProducto[]> {
    return this.http.get<IProducto[]>(this.apiurl + 'todos');
  }

  // Método para obtener un producto por su ID
  uno(idProductos: number): Observable<IProducto> {
    const formData = new FormData();
    formData.append('idProductos', idProductos.toString());
    return this.http.post<IProducto>(this.apiurl + 'uno', formData);
  }

  // Método para eliminar un producto por su ID
  eliminar(idProductos: number): Observable<number> {
    const formData = new FormData();
    formData.append('idProductos', idProductos.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  // Método para insertar un nuevo producto junto con el kardex
  insertar(producto: IProducto): Observable<string> {
    const formData = new FormData();
    formData.append('Codigo_Barras', producto.Codigo_Barras);
    formData.append('Nombre_Producto', producto.Nombre_Producto);
    formData.append('Graba_IVA', producto.Graba_IVA.toString());
    formData.append('Unidad_Medida_idUnidad_Medida', producto.Unidad_Medida_idUnidad_Medida.toString());
    formData.append('IVA_idIVA', producto.IVA_idIVA.toString());
    formData.append('Cantidad', producto.Cantidad.toString());
    formData.append('Valor_Compra', producto.Valor_Compra.toString());
    formData.append('Valor_Venta', producto.Valor_Venta.toString());
    formData.append('Proveedores_idProveedores', producto.Proveedores_idProveedores.toString());

    // Insertar el producto y kardex
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  // Método para actualizar un producto
  actualizar(producto: IProducto): Observable<string> {
    const formData = new FormData();
    formData.append('idProductos', producto.idProductos.toString());
    formData.append('Codigo_Barras', producto.Codigo_Barras);
    formData.append('Nombre_Producto', producto.Nombre_Producto);
    formData.append('Graba_IVA', producto.Graba_IVA.toString());

    // Actualizar el producto
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }
}
