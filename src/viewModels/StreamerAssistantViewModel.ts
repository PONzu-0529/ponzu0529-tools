import { Component, Watch } from 'vue-property-decorator';
import Base from '@/viewModels/Base';

@Component({})
export class StreamerAssistantViewModel extends Base {
  // Stream Option
  protected currentStreamOption: CustomStreamOption;
  protected streamOptionList: StreamOption;

  protected get isNotEmptyStreamOptionList(): boolean {
    return this.streamOptionList.streamOptionList.length !== 0;
  }

  @Watch('streamOptionList')
  protected onChangeStreamOptionList(): void {
    if (this.isNotEmptyStreamOptionList) this.currentStreamOption = this.streamOptionList.streamOptionList[0];
  }

  constructor() {
    super();

    this.streamOptionList = {
      description: '',
      streamOptionList: []
    };
    this.currentStreamOption = {
      title: '',
      streamTitle1: '',
      streamTitle2: ''
    };
  }

  protected downloadSettingFile(): void {
    const strData = JSON.stringify(this.streamOptionList);
    const blob = new Blob([strData], { 'type': 'text.json' });
    (this.$refs.downloadSettingFile as HTMLAnchorElement).href = window.URL.createObjectURL(blob);
  }
}

export interface StreamOption {
  description: string
  streamOptionList: Array<CustomStreamOption>
}

export interface CustomStreamOption {
  title: string
  streamTitle1: string
  streamTitle2: string
}
