import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ResourceNotFoundComponent } from './resource-not-found.component';

describe('ResourceNotFoundComponent', () => {
  let component: ResourceNotFoundComponent;
  let fixture: ComponentFixture<ResourceNotFoundComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ResourceNotFoundComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ResourceNotFoundComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
