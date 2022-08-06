import { Pipe, PipeTransform } from '@angular/core';
<<<<<<< HEAD

=======
>>>>>>> c89114ba562614ca0ccbefe387d52d22d445dfcf
@Pipe({
  name: 'productFilter'
})
export class ProductFilterPipe implements PipeTransform {

  transform(value: unknown, ...args: unknown[]): unknown {
    return null;
  }

}
