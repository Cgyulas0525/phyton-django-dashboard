# -*- encoding: utf-8 -*-
"""
Copyright (c) 2019 - present AppSeed.us
"""

from django.db import models
from django.contrib.auth.models import User
from datetime import date

# Create your models here.

class types(models.Model):
    nev = models.CharField(max_length=191, blank=True)
    leiras = models.TextField(blank=True, null=True)
    user_id = models.IntegerField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class feladat(models.Model):
    mit = models.CharField(max_length=255, blank=True)
    mikorra = models.DateField(blank=True)
    vege = models.DateField(blank=True, null=True)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

class dictionaries(models.Model):
    tipus = models.ForeignKey(types, on_delete=models.CASCADE)
    nev = models.CharField(max_length=191, blank=True)
    leiras = models.TextField(blank=True, null=True)
    user_id = models.IntegerField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev


class telepules(models.Model):
    iranyitoszam = models.CharField(max_length=4, blank=True)
    telepules = models.CharField(max_length=64, blank=True)
    megye = models.CharField(max_length=64, blank=True)
    jaras = models.CharField(max_length=64, blank=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.telepules

class partner(models.Model):
    nev = models.CharField(max_length=100, blank=True)
    tipus = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    adoszam = models.CharField(max_length=15, blank=True)
    bankszamla = models.CharField(max_length=30, blank=True)
    isz = models.CharField(max_length=4, blank=True)
    telepules = models.ForeignKey(telepules, on_delete=models.CASCADE)
    cim = models.CharField(max_length=100, blank=True)
    email = models.EmailField(max_length=50, blank=True)
    telefonszam = models.CharField(max_length=20, blank=True)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class termekfocsoport(models.Model):
    nev = models.CharField(max_length=100, blank=True)
    tsz = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class termekcsoport(models.Model):
    focsoport = models.ForeignKey(termekfocsoport, on_delete=models.CASCADE)
    nev = models.CharField(max_length=100, blank=True)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class termek(models.Model):
    csoport = models.ForeignKey(termekcsoport, on_delete=models.CASCADE)
    nev = models.CharField(max_length=100, blank=True)
    cikkszam = models.CharField(max_length=25, blank=True)
    me = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class koltsegfocsoport(models.Model):
    nev = models.CharField(max_length=100, blank=True)
    tsz = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev

class koltsegcsoport(models.Model):
    focsoport = models.ForeignKey(koltsegfocsoport, on_delete=models.CASCADE)
    nev = models.CharField(max_length=100, blank=True)
    megjegyzes = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.nev


class szamla(models.Model):
    partner = models.ForeignKey(partner, on_delete=models.CASCADE)
    szamlaszam = models.CharField(max_length=25, blank=True)
    fizetesimod = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    osszeg = models.DecimalField(max_digits=10, decimal_places=2)
    kelt = models.DateField(auto_now_add=True, blank=True)
    teljesites = models.DateTimeField(blank=True)
    fizetesihatarido = models.DateTimeField(blank=True)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)

    def __str__(self):
        return self.szamlaszam

class szamlatetel(models.Model):
    szamla = models.ForeignKey(szamla, on_delete=models.CASCADE)
    termek = models.ForeignKey(termek, on_delete=models.CASCADE)
    koltseg = models.ForeignKey(koltsegcsoport, on_delete=models.CASCADE)
    afaszaz = models.ForeignKey(dictionaries, on_delete=models.CASCADE)
    netto = models.DecimalField(max_digits=10, decimal_places=2)
    afa = models.DecimalField(max_digits=10, decimal_places=2)
    brutto = models.DecimalField(max_digits=10, decimal_places=2)
    created_at = models.DateTimeField(auto_now_add=True, blank=True)
    updated_at = models.DateTimeField(null=True, blank=True)
    deleted_at = models.DateTimeField(null=True, blank=True)
