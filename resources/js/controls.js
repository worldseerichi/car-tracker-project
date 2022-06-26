 class CenterFilter {
    static contructor(map){
      this.controlDiv = document.createElement('div');
      this.controlUI = document.createElement('div');
      this.controlText = document.createElement('div');

      this.controlUI.style.backgroundColor = '#fff';
      this.controlUI.style.border = '1px solid #ebebeb'
      this.controlUI.style.borderRadius = '3px';
      this.controlUI.style.padding = '6px';
      this.controlUI.title = 'Filtrar Mapa';

      this.controlDiv.appendChild(this.controlUI);  

      this.controlText.style.fontSize = '16px';
      this.controlText.style.textAlign = 'center';
      this.controlText.style.lineHeight = '20px';
      this.controlText.style.color = '#333';
      this.controlText.innerHTML = 'Filtrar';

      this.controlDiv.appendChild(this.controlText);
    }
  }

