import { environment } from "src/environments/environment";

export const baseUrl = environment.production ? 'url' : 'http://localhost:4200';
export const productUrl = baseUrl + '/products';
export const cartUrl = baseUrl + '/cart';
export const productByIDUrl = baseUrl + '/products/1';
export const wishListUrl = baseUrl + '/wishlist';
