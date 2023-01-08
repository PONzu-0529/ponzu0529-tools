<template>
  <div class="streamer-assistant">
    <h1 class="title">{{ viewTitle }}</h1>
    <b-field horizontal>
      <b-button>
        <b-upload v-model="streamOptionFile">
          {{ uploadSettingLabel }}
        </b-upload>
      </b-button>
      <b-button>
        <a
          download="StreamerAssistantSettings.json"
          ref="downloadSettingFile"
          @click="downloadSettingFile"
        >
          {{ downloadSettingLabel }}
        </a>
      </b-button>
    </b-field>
    <template v-if="isNotEmptyStreamOptionList">
      <b-field>
        <b-select v-model="currentStreamOption">
          <option
            v-for="(streamOption, index) in streamOptionList.streamOptionList"
            :value="streamOption"
            :key="`streamOption_${index}`"
          >
            {{ streamOption.title }}
          </option>
        </b-select>
      </b-field>
      <b-field horizontal :label="streamOptionTitleLabel">
        <b-input v-model="currentStreamOption.title"></b-input>
      </b-field>
      <b-field horizontal :label="streamTitle1Label">
        <b-input v-model="currentStreamOption.streamTitle1"></b-input>
      </b-field>
      <b-field horizontal :label="streamTitle2Label">
        <b-input v-model="currentStreamOption.streamTitle2"></b-input>
      </b-field>
    </template>
  </div>
</template>

<script lang="ts">
import { Component, Watch } from 'vue-property-decorator';
import { StreamerAssistantViewModel } from '@/viewModels/StreamerAssistantViewModel';

@Component({})
export default class StreamerAssistant extends StreamerAssistantViewModel {
  private streamOptionFile: File | null;

  // Label
  private uploadSettingLabel: string;
  private downloadSettingLabel: string;
  private streamOptionTitleLabel: string;
  private streamTitle1Label: string;
  private streamTitle2Label: string;

  @Watch('streamOptionFile')
  private async onChangeStreamOptionFile(): Promise<void> {
    if (this.streamOptionFile === null) return;
    this.streamOptionList = JSON.parse(await this.streamOptionFile.text());
  }

  constructor() {
    super();

    this.viewTitle = '配信者支援ツール';
    this.uploadSettingLabel = '設定読み込み';
    this.downloadSettingLabel = '設定書き込み';
    this.streamOptionTitleLabel = '種類';
    this.streamTitle1Label = 'タイトル(前)';
    this.streamTitle2Label = 'タイトル(後)';

    this.streamOptionFile = null;
  }
}
</script>
