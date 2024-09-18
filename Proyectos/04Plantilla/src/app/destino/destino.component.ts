import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { ICliente } from '../Interfaces/icliente';
import { ClientesService } from '../Services/clientes.service';
import Swal from 'sweetalert2';
import { IDestino } from '../Interfaces/destino.interface';
import { DestinoService } from '../Services/destino.service';
@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './clientes.component.html',
})
export class DestinoComponent {
  listadestino: IDestino[] = [];
  constructor(private destinoService: DestinoService) {}

  ngOnInit() {
    this.cargatabla();
  }
  cargatabla() {
    this.destinoService.todos().subscribe((data) => {
      console.log(data);
      this.listadestino = data;
    });
  }
  eliminar(destino_id) {
    Swal.fire({
      title: 'Destino',
      text: 'Esta seguro que desea eliminar el Destino!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Destino'
    }).then((result) => {
      if (result.isConfirmed) {
        this.destinoService.eliminar(destino_id).subscribe((data) => {
          Swal.fire('Destino', 'El Destino ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
