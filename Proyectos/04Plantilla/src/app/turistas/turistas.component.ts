import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { ICliente } from '../Interfaces/icliente';
import { ClientesService } from '../Services/clientes.service';
import Swal from 'sweetalert2';
import { ITurista } from '../Interfaces/turistas.interface';
import { TuristaService } from '../Services/turistas.service';
@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './clientes.component.html',
})
export class TuristaComponent {
  listaturistas: ITurista[] = [];
  constructor(private turistaService: TuristaService) {}

  ngOnInit() {
    this.cargatabla();
  }
  cargatabla() {
    this.turistaService.todos().subscribe((data) => {
      console.log(data);
      this.listaturistas = data;
    });
  }
  eliminar(turista_id) {
    console.log(turista_id);
    Swal.fire({
      title: 'Eliminar',
      text: 'Esta seguro que desea eliminar el turista!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Emliminar turista'
    }).then((result) => {
      if (result.isConfirmed) {
        this.turistaService.eliminar(turista_id).subscribe((data) => {
          Swal.fire('Turista', 'El turista ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
