# Plan detallado para estandarizar nombres de archivos y carpetas a minúsculas

Este documento describe los pasos a seguir para modificar los nombres de archivos y carpetas en el repositorio local, actualizar las rutas internas y sincronizar los cambios con el servidor remoto Linux.

## 1. Preparación inicial

1.1. Abrir la terminal en el directorio del proyecto:
- `cd c:\xampp8\htdocs\portafolio-MarceloVonkunoschy`

1.2. Revisar el estado actual del repositorio:
- `git status`
- `git branch`

1.3. Confirmar que no hay cambios pendientes o guardarlos en un stash temporal si existen:
- `git stash push -m "stash antes de renombrar paths"`

1.4. Configurar Git para respetar diferencias entre mayúsculas y minúsculas:
- `git config core.ignorecase false`

## 2. Auditoría de nombres y rutas

2.1. Generar la lista completa de archivos y carpetas del repositorio:
- `git ls-files`

2.2. Identificar nombres que contengan mayúsculas y que deban convertirse a minúsculas.

2.3. Crear una lista de correspondencia:
- ruta actual -> ruta final en minúsculas

2.4. Revisar posibles conflictos de nombres, por ejemplo:
- `Folder` y `folder` en el mismo directorio
- `Archivo.php` y `archivo.php`

## 3. Renombrar con Git para forzar el cambio de case

3.1. Realizar el cambio en dos pasos para cada archivo/carpeta afectada:
- renombrar a un nombre temporal intermedio
- renombrar de temporal a la versión minúscula

Por ejemplo:
- `git mv src/Carpeta temp-carpeta`
- `git mv temp-carpeta src/carpeta`

3.2. Usar `git mv` en lugar de `mv` para que Git registre el movimiento y los cambios de nombre.

3.3. Si hay muchos archivos, usar un script o comandos iterativos para automatizar el proceso ordenando la lista de nombres.

3.4. Confirmar con `git status` después de renombrar.

## 4. Actualizar referencias internas y rutas en el código

4.1. Buscar todas las referencias a rutas y nombres de archivos:
- `include`, `require`, `require_once`
- `import`, `export` o `use` (según el stack)
- rutas de CSS/JS en HTML
- rutas de enlaces internos en el proyecto

4.2. Corregir cada referencia para usar las nuevas rutas en minúsculas.

4.3. Revisar especialmente:
- `include/header.php`
- `include/footer.php`
- archivos PHP del proyecto principal
- cualquier archivo en `assets`, `src`, `marcovonkudj` y subcarpetas

4.4. Validar que no queden referencias rotas o rutas mixtas con mayúsculas.

## 5. Probar localmente

5.1. Iniciar el servidor local (XAMPP o servidor web local).

5.2. Navegar por el sitio y verificar que las páginas se cargan sin errores de archivo no encontrado.

5.3. Probar enlaces, formularios, inclusiones de archivos y recursos estáticos.

5.4. Corregir cualquier error de ruta que aparezca durante la prueba local.

## 6. Confirmar los cambios y realizar el commit

6.1. Añadir los cambios al índice de Git:
- `git add -u`

6.2. Revisar los cambios listos para commit:
- `git status`
- `git diff --cached`

6.3. Crear un commit claro:
- `git commit -m "Estandarizar nombres de archivos y carpetas a minúsculas"`

## 7. Subir los cambios al repositorio remoto

7.1. Enviar los cambios al remoto:
- `git push`

7.2. Si el servidor Linux usa otro flujo de despliegue, seguir el proceso establecido para actualizar el código.

## 8. Verificar en el servidor Linux

8.1. En el servidor remoto, actualizar la copia:
- `git pull`

8.2. Limpiar caches del servidor o reiniciar el servicio web si es necesario.

8.3. Probar el sitio en el servidor Linux y verificar que todas las rutas funcionen correctamente.

8.4. Confirmar que no hay errores de "file not found" causados por diferencias de mayúsculas y minúsculas.

## 9. Pasos finales y mantenimiento

9.1. Mantener la convención de nombres en minúsculas para todos los nuevos archivos y carpetas.

9.2. Documentar la convención en un archivo README o en notas de desarrollo.

9.3. Si se desea, crear una regla de revisión para controlar futuros nombres de ruta y evitar mezclas de mayúsculas/minúsculas.
